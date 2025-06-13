const openComponentForm = document.getElementById('openComponentForm')
openComponentForm?.addEventListener('click', toggleForm)
const closeComponentForm = document.getElementById('closeComponentForm')
closeComponentForm?.addEventListener('click', toggleForm)

function toggleForm() {
    const modal = document.getElementById('formModal');
    modal.classList.toggle('hidden');
}

let effectIndex = 0;

const addEffectElement = document.getElementById('add-effect');
const addNewEffect = document.getElementById('add-edit-effect')


// function createEffectRow(location) {
//     const container = document.getElementById(location);
//     const newRow = document.getElementById("effect-row-template")?.cloneNode(true)
//     if (!newRow)
//         return;
//     const select = newRow.querySelector('select');
//     select.name = `effects[${effectIndex}][id]`;
//     const input = newRow.querySelector('input');
//     input.name = `effects[${effectIndex}][value]`;
//     newRow.hidden = false
//
//
//     container.appendChild(newRow);
//     effectIndex++;
// }


// createEffectRow('effects-container');

// addEffectElement?.addEventListener('click', function (event) {
//     event.preventDefault()
//     createEffectRow('effects-container');
// });


// addNewEffect?.addEventListener('click', function (event) {
//     event.preventDefault()
//     createEffectRow('edit-effect-container');
// });
