/** @type {?HTMLInputElement} */
const componentSearch = document.getElementById('component-search');
if (componentSearch) {
    const accordions = document.querySelectorAll('.sim-component-group-accordion');
    const emptyState = document.getElementById('category-library-empty-state');

    const getSanitizedTextContent = elem => elem.textContent
        .replaceAll('  ', '')
        .replaceAll('\n\n', '\n')
        .trim()
        .toLowerCase();

    const getSanitizedSearchQuery = () => componentSearch.value
        .replaceAll('  ', '')
        .trim()
        .toLowerCase();

    const filterAccordions = () => {
        const filteredAccordions = Array.from(accordions).filter(accordion => getSanitizedTextContent(accordion)
            .includes(getSanitizedSearchQuery()));

        emptyState.toggleAttribute('aria-hidden', filteredAccordions.length > 0);
        emptyState.toggleAttribute('hidden', filteredAccordions.length > 0);

        // Hide accordions
        accordions.forEach(accordion => {
            accordion.toggleAttribute('aria-hidden', true);
            accordion.toggleAttribute('hidden', true);
            accordion.toggleAttribute('open', false);
        });

        // Show filtered accordions
        filteredAccordions.forEach(accordion => {
            const components = accordion.querySelectorAll('.sim-component');
            const filteredComponents = Array.from(components).filter(component => getSanitizedTextContent(component)
                .includes(getSanitizedSearchQuery()));

            // Open the groups, but only if the user actually entered a search query.
            if (getSanitizedSearchQuery().length > 0) {
                accordion.toggleAttribute('open', true);
            }

            accordion.toggleAttribute('aria-hidden', filteredComponents.length < 1);
            accordion.toggleAttribute('hidden', filteredComponents.length < 1);

            emptyState.toggleAttribute('aria-hidden', filteredComponents.length > 0);
            emptyState.toggleAttribute('hidden', filteredComponents.length > 0);

            components.forEach(component => {
                component.toggleAttribute('aria-hidden', true);
                component.toggleAttribute('hidden', true);
            });
            filteredComponents.forEach(component => {
                component.toggleAttribute('aria-hidden', false);
                component.toggleAttribute('hidden', false);
            });
        });
    }
    filterAccordions();
    componentSearch.addEventListener('input', filterAccordions);
}
