import './bootstrap';

const components = document.querySelectorAll('.component');
const gridItems = document.querySelectorAll('.grid-item');
const library = document.querySelector('.library');


/* CURRENT ISSUES
- when dragging component and dropping it in library the component is removed

test the functionality!
 */
addDragAndDropListeners()
function addDragAndDropListeners() {

    library.addEventListener('dragover', dragOverHandler);
    library.addEventListener('drop', dropHandlerLibrary)

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
    if (parentEle.classList.contains('library')) {
        fromLibrary = true;
    }

    event.dataTransfer.setData('fromLibrary', fromLibrary ? 'true' : 'false');
    event.dataTransfer.setData('text/plain', event.target.id);
}

function dragOverHandler(event) {
    event.preventDefault();
}

function dropHandlerGrid(event) {
    const data = event.dataTransfer.getData('text/plain');
    const fromLibrary = event.dataTransfer.getData('fromLibrary');
    const draggedComponent = document.getElementById(data);

    // If the grid has component then target will have class component
    if (event.target.classList.contains('component')) {
        console.warn("Cannot drop a component into a grid that already has a component");
        return;
    }

    // When a component is dragged from the library, clone it and place the clone in target
    // If it's not from library simply append the dragged element to target
    let clonedComponent;
    if (fromLibrary === 'true') {
        event.preventDefault();
        clonedComponent = draggedComponent.cloneNode(true);
        // replace for more sensible solution for ID-generation
        draggedComponent.id = `component-${Math.random()}`;
        clonedComponent.addEventListener('dragstart', dragStartHandler);
        event.target.appendChild(clonedComponent);
    } else {
        event.target.appendChild(draggedComponent);
    }



    console.log(`dragged and dropped successfully`)
}


function dropHandlerLibrary(event) {
    const data = event.dataTransfer.getData('text/plain');
    const draggedComponent = document.getElementById(data);
    const fromLibrary = event.dataTransfer.getData('fromLibrary');

    if (fromLibrary === 'false') {
        draggedComponent.remove();
    }
}
