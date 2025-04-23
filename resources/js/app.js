import './bootstrap';

const components = Array.from(document.querySelectorAll('.component'));
const gridItems = Array.from(document.querySelectorAll('.grid-item'));
const library = document.querySelector('.library');


/* CURRENT ISSUES
- When drag and drop fails you can drop multiple items in one grid
because the dragover listener is added when it shouldn't.
the dragover listener should only be added if component is dropped in valid place
- clone a component from library instead of taking it away
- when a component from the grid the component in the grid should be removed
 */
// console.log(library);
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
    let parentElement = event.target.parentElement;

    if (parentElement.className === 'grid-item') {
        parentElement.addEventListener("dragover", dragOverHandler);
    }

    event.dataTransfer.setData('text/plain', event.target.id);
}

function dragOverHandler(event) {
    event.preventDefault();
}

function dropHandlerGrid(event) {
    const data = event.dataTransfer.getData('text/plain');
    const draggedElement = document.getElementById(data);

    // cannot place the dragged element back into itself
    if (draggedElement.contains(event.target)) {
        console.warn("Cannot append an ancestor into its own descendant");
    } else {
        event.preventDefault();
        event.target.appendChild(draggedElement);
        event.target.removeEventListener("dragover", dragOverHandler);
    }
}


function dropHandlerLibrary(event) {
    console.log(event);
    event.preventDefault();
    const data = event.dataTransfer.getData('text/plain');
    console.log(data);
    event.target.appendChild(document.getElementById(data));
}
