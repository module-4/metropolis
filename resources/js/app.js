import './bootstrap';
import { updateSimulationComponent } from './componentHandler.js';

const components = document.querySelectorAll('.sim-component');
const gridItems = document.querySelectorAll('.sim-grid-tile');
const library = document.querySelector('.sim-component-library');

/* CURRENT ISSUES

test the functionality!
 */
addDragAndDropListeners()
function addDragAndDropListeners() {

    library.addEventListener('dragover', dragOverHandler);
    library.addEventListener('drop', dropHandlerLibrary);

    components.forEach(component => {
        component.addEventListener('dragstart', dragStartHandler);
    });

    gridItems.forEach(gridItem => {
        gridItem.addEventListener('dragover', dragOverHandler);
        gridItem.addEventListener('drop', dropHandlerGrid);
    })
}

function dragStartHandler(event) {
    const parentEle = event.target.parentElement;
    let fromLibrary = false;
    if (parentEle.classList.contains('sim-component-group')) {
        fromLibrary = true;
    }

    console.log(event.target?.id, event.currentTarget?.id)
    event.dataTransfer.setData('fromLibrary', fromLibrary ? 'true' : 'false');
    event.dataTransfer.setData('text/plain', event.target.id);
}

function dragOverHandler(event) {
    event.preventDefault();
}

async function dropHandlerGrid(event) {
    const data = event.dataTransfer.getData('text/plain');
    const fromLibrary = event.dataTransfer.getData('fromLibrary');
    const draggedComponent = document.getElementById(data);
    const componentId = parseInt(draggedComponent.getAttribute('data-component-id'));
    const x = parseInt(event.currentTarget.getAttribute('data-x'));
    const y = parseInt(event.currentTarget.getAttribute('data-y'));

    // If the grid has component then target will have class component
    if (event.target.classList.contains('sim-component')) {
        //console.warn("Cannot drop a component into a grid that already has a component");
        return;
    }

    if (!componentId || isNaN(componentId)) {
        // No componentId provided, or provided componentId is not of type number.
        return;
    }
    if (([null, undefined].includes(x) || isNaN(x)) || ([null, undefined].includes(y) || isNaN(y))) {
        // No x / y values were provided, or provided x / y values are not of type number.
        return;
    }

    // When a component is dragged from the library, clone it and place the clone in target
    // If it's not from library simply append the dragged element to target
    let clonedComponent;
    if (fromLibrary === 'true') {
        event.preventDefault();
        clonedComponent = draggedComponent.cloneNode(true);
        // replace for more sensible solution for ID-generation
        clonedComponent.id = `component-${Math.random()}`;
        clonedComponent.addEventListener('dragstart', dragStartHandler);
        event.target.appendChild(clonedComponent);
    } else {
        event.target.appendChild(draggedComponent);
    }

    await updateSimulationComponent(1, componentId, x, y);

    //console.log(`dragged and dropped successfully`)
}


function dropHandlerLibrary(event) {
    const data = event.dataTransfer.getData('text/plain');
    const draggedComponent = document.getElementById(data);
    const fromLibrary = event.dataTransfer.getData('fromLibrary');

    if (fromLibrary === 'false') {
        draggedComponent.remove();
    }
}
