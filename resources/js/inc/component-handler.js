const updateEffectsList = (effects) => {
    const effectsList = document.getElementById('sim-effects-list');

    while(effectsList.lastChild) {
        effectsList.lastChild.remove();
    }
    const effectEntries = Object.entries(effects);
    if (effectEntries.length === 0) {
        const emptyStateMessage = document.createElement('p');
        emptyStateMessage.textContent = 'No effects found';
        return;
    }

    effectEntries.forEach(([key, value]) => {
        const effect = document.createElement('div');
        effect.classList.add(
            'bg-white',
            'border',
            'border-gray-200',
            'px-4',
            'py-2',
            'rounded-md',
            'text-black'
        );
        effect.textContent = `${key} ${value}`;
        effectsList.append(effect);
    })
}

/**
 * Initialize the drag start handler for a component.
 * @param {DragEvent} e
 */
const componentDragStartHandler = e => {
    const component = e.currentTarget;
    const parentElem = component.parentElement;
    const componentId = parseInt(component.getAttribute('data-component-id'));

    if (typeof componentId !== 'number') {
        // No componentId was provided, or provided componentId is not of type number.
        return;
    }

    const origin = parentElem.classList.contains('sim-component-group') ? 'library' : 'grid';
    const data = {
        componentId,
        targetId: component.id,
        origin: {
            name: origin
        }
    };

    if (origin !== 'library') {
        const x = parseInt(parentElem.getAttribute('data-x'));
        const y = parseInt(parentElem.getAttribute('data-y'));

        if (typeof x !== 'number' || typeof y !== 'number') {
            // No x / y coordinates were provided, or provided x / y coordinates are not of type number.
            return;
        }

        data.origin.x = x;
        data.origin.y = y;
    }

    e.dataTransfer.setData('text/json', JSON.stringify(data));
}

/**
 * Initialize the drop handler for a grid item.
 * @param {Event} e
 * @param {Simulation} simulation
 * @returns {Promise<void>}
 */
const gridItemDropHandler = async (e, simulation) => {
    const data = JSON.parse(e.dataTransfer.getData('text/json') ?? "{}");
    const draggedComponent = document.getElementById(data.targetId);
    const componentId = parseInt(draggedComponent.getAttribute('data-component-id'));
    const x = parseInt(e.currentTarget.getAttribute('data-x'));
    const y = parseInt(e.currentTarget.getAttribute('data-y'));

    // If the grid has component then target will have class component
    if (e.target.classList.contains('sim-component')) return;

    if (typeof componentId !== 'number') return;
    if (typeof x !== 'number' || typeof y !== 'number') return;

    // If the dragged component's origin is the grid, update the position
    if (data.origin.name === 'grid') {
        e.target.appendChild(draggedComponent);
        await simulation.updateComponentPosition(data.origin.x, data.origin.y, x, y, (success, data) => {
            if (success) updateEffectsList(data.effects);
        });
        return;
    }

    // If the dragged component's origin is the library, add it to the grid by cloning the original
    let clonedComponent;
    if (data.origin.name === 'library') {
        e.preventDefault();
        clonedComponent = draggedComponent.cloneNode(true);

        const randomBytes = Array.from(crypto.getRandomValues(new Uint8Array(8)))
            .map(b => b.toString(16).padStart(2, '0'))
            .join('');

        clonedComponent.id = `component-${randomBytes}`;
        clonedComponent.addEventListener('dragstart', componentDragStartHandler);
        e.target.appendChild(clonedComponent);

        await simulation.addComponentAtPosition(componentId, x, y, (success, data) => {
            if (success) updateEffectsList(data.effects);
        });
    }
}

/**
 * Initialize the drop handler for the library.
 * @param {Event} e
 * @param {Simulation} simulation
 * @returns {Promise<void>}
 */
const libraryDropHandler = async (e, simulation) => {
    const data = JSON.parse(e.dataTransfer.getData('text/json') ?? "{}");
    const draggedComponent = document.getElementById(data.targetId);

    // If a component is dragged from the grid
    if (data.origin.name === 'grid') {
        const x = parseInt(draggedComponent.parentElement.getAttribute('data-x'));
        const y = parseInt(draggedComponent.parentElement.getAttribute('data-y'));

        draggedComponent.remove();

        if (typeof x !== 'number' || typeof y !== 'number') return;
        await simulation.deleteComponentAtPosition(x, y, (success, data) => {
            if (success) updateEffectsList(data.effects);
        });
    }
}

const components = document.querySelectorAll('.sim-component');
const gridItems = document.querySelectorAll('.sim-grid-tile');
const library = document.querySelector('.sim-component-library');

/**
 * Initialize the drag and drop listeners.
 * @param {Simulation} simulation
 */
export const initializeDragAndDropListeners = (simulation) => {
    library.addEventListener('dragover', e => e.preventDefault());
    library.addEventListener('drop', e => libraryDropHandler(e, simulation));

    components.forEach(component => {
        component.addEventListener('dragstart', componentDragStartHandler);
    });

    gridItems.forEach(gridItem => {
        gridItem.addEventListener('dragover', e => e.preventDefault());
        gridItem.addEventListener('drop', e => gridItemDropHandler(e, simulation));
    });
}

/**
 * Initialize the hover listeners.
 * @param {Simulation} simulation
 */
export const initializeHoverListeners = (simulation) => {
    /** @type {number?} */
    let hoverTimeout = null;

    /**
     * Initialize the mouse enter handler for a grid item.
     * @param {MouseEvent} e
     * @param {Simulation} simulation
     * @returns {Promise<void>}
     */
    const gridItemMouseEnterHandler = async (e, simulation) => {
        const x = parseInt(e.currentTarget.getAttribute('data-x'));
        const y = parseInt(e.currentTarget.getAttribute('data-y'));

        if (typeof x !== 'number' || typeof y !== 'number') return;

        if (hoverTimeout) {
            clearTimeout(hoverTimeout);
            hoverTimeout = null;
        }

        hoverTimeout = setTimeout(async () => {
            await simulation.getNeighborsFromPosition(x, y, (success, data) => {
                if (!success) {
                    console.error(data);
                    return;
                }

                for (const neighbor of data.neighbors) {
                    const tileInfo = document.querySelector(`.sim-grid-tile[data-x="${neighbor.x}"][data-y="${neighbor.y}"] .tile-info`);
                    const tileInfoEffectsList = document.querySelector(`.sim-grid-tile[data-x="${neighbor.x}"][data-y="${neighbor.y}"] .tile-info > ul`);

                    while (tileInfoEffectsList.lastChild) {
                        tileInfoEffectsList.lastChild.remove();
                    }

                    for (const effect of neighbor.effects) {
                        Object.entries(effect).forEach(([key, value]) => {
                            const li = document.createElement('li');
                            li.textContent = `${key}, ${value}`;
                            tileInfoEffectsList.appendChild(li);
                        });
                    }
                    if (neighbor.effects.length > 0) {
                        tileInfo.setAttribute('aria-hidden', 'false');
                    }
                }
            });
            hoverTimeout = null;
        }, 500);
    }

    /**
     * Initialize the mouse leave handler for a grid item.
     * @param {MouseEvent} e
     * @param {Simulation} simulation
     * @returns {Promise<void>}
     */
    const gridItemMouseLeaveHandler = (e, simulation) => {
        if (hoverTimeout) {
            clearTimeout(hoverTimeout);
            hoverTimeout = null;
        }
        document.querySelectorAll('.sim-grid-tile .tile-info').forEach(tileInfo => {
            tileInfo.setAttribute('aria-hidden', 'true');
        });
    }

    gridItems.forEach(gridItem => {
        gridItem.addEventListener('mouseleave', e => gridItemMouseLeaveHandler(e, simulation));
        gridItem.addEventListener('mouseenter', e => gridItemMouseEnterHandler(e, simulation));
    });
}
