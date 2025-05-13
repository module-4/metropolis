
/**
 * Update the position for a component in a simulation
 * @param {number} simulationId
 * @param {number} componentId
 * @param {number} x
 * @param {number} y
 * @returns {Promise<Record<any, number>>}
 * */
export const updateSimulationComponent = async (simulationId, componentId, x, y) => {
    console.log('started: updateSimulationComponent');
    const response = await fetch(
        `/api/simulation/${simulationId}/component?componentId=${componentId}&x=${x}&y=${y}`,
        {
            method: 'PUT'
        }
    );
    const json = await response.json();
    console.log('completed: updateSimulationComponent', json);
    const simEffectsList = document.getElementById('sim-effects-list');

    // Clear sim effects list
    while(simEffectsList.lastChild) {
        simEffectsList.lastChild.remove();
    }

    // Fill it with the response from the API
    Object.entries(json).forEach(([key, value]) => {
        const simEffect = document.createElement('div');
        simEffect.className = 'bg-white border border-gray-200 px-4 py-2 rounded-md text-black';
        simEffect.textContent = `${key} ${value}`;
        simEffectsList.append(simEffect);
    });

    return json;
}

/**
 * Delete a component from a simulation where the specified x and y coordinates match
 * @param {number} simulationId
 * @param {number} x
 * @param {number} y
 * @returns {Promise<boolean>}
 * */
export const deleteSimulationComponent = async (simulationId, x, y) => {
    console.log('started: deleteSimulationComponent');
    const response = await fetch(
        `/api/simulation/${simulationId}/component?&x=${x}&y=${y}`,
        {
            method: 'DELETE'
        }
    );
    const json = await response.json();
    console.log('completed: deleteSimulationComponent', json);
    return json;
}
