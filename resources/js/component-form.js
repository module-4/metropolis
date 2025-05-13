document.getElementById('openComponentForm').addEventListener('click', toggleForm)
document.getElementById('closeComponentForm').addEventListener('click', toggleForm)

function toggleForm() {
    const modal = document.getElementById('formModal');
    modal.classList.toggle('hidden');
}
