document.getElementById('openComponentForm').addEventListener('click', toggleForm)
document.getElementById('closeComponentForm').addEventListener('click', toggleForm)
document.getElementById('openComponenteditForm').addEventListener('click', openeditForm)
document.getElementById('closeComponenteditForm').addEventListener('click', closeeditForm)


function toggleForm() {
    const modal = document.getElementById('formModal');
    modal.classList.toggle('hidden');
}
function closeeditForm(){
    document.getElementById('editModal-{{ $simComponent->id }}').close()
}
function openeditForm() {
    document.getElementById('editModal-{{ $simComponent->id }}').showModal()
}

let effectIndex = 1;

const effectsList = $effects;
document.getElementById('add-effect').addEventListener('click', function ()
{ const container = document.getElementById('effects-container');

const newRow = document.createElement('div');
newRow.classList.add('effect-row');
let options = effectsList.map(effect => `<option value="${effect.id}">${effect.name}</option>`).join('');
newRow.innerHTML = `
 <select name="effects[${effectIndex}][id]" required>${options}</select>
 <input type="text" name="effects[${effectIndex}][value]" placeholder="Effect Value" required> `; container.appendChild(newRow); effectIndex++; });
