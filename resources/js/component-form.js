document.getElementById('openComponentForm').addEventListener('click', toggleForm)
document.getElementById('closeComponentForm').addEventListener('click', toggleForm)


function toggleForm() {
    const modal = document.getElementById('formModal');
    modal.classList.toggle('hidden');
}

let effectIndex = 0;

const addEffectElement = document.getElementById('add-effect');


function createEffectRow() {
    const container = document.getElementById('effects-container');
    const newRow = document.getElementById('effect-row-template').cloneNode(true)
    newRow.hidden = false;
    const select = newRow.querySelector('select');
    select.name = `effects[${effectIndex}][id]`;
    const input = newRow.querySelector('input');
    input.name = `effects[${effectIndex}][value]`;

    container.appendChild(newRow);
    effectIndex++;
}

console.log(addEffectElement)

createEffectRow();

addEffectElement.addEventListener('click', function () {
    createEffectRow();
});
