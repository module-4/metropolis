/** @type {?HTMLInputElement} */
const componentSearch = document.getElementById('component-search');
if (componentSearch) {
    const accordions = document.querySelectorAll('.sim-component-group-accordion');

    componentSearch.addEventListener('input', e => {
        if (!accordions || accordions?.length < 1) return;

        const filteredAccordions = Array.from(accordions).filter(accordion => {
            return accordion.textContent
                .replaceAll('  ', '')
                .replaceAll('\n\n', '\n')
                .trim()
                .toLowerCase()
                .includes(componentSearch.value.
                    replaceAll('  ', '')
                    .trim()
                    .toLowerCase()
                );
        });

        // Hide accordions
        accordions.forEach(accordion => {
            accordion.toggleAttribute('aria-hidden', true);
            accordion.toggleAttribute('hidden', true);
        });

        // Show filtered accordions
        filteredAccordions.forEach(accordion => {
            accordion.toggleAttribute('aria-hidden', false);
            accordion.toggleAttribute('hidden', false);
        });
    });
}
