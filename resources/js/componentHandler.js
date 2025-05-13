
/**
 * Update the position for a component in a simulation
 * @param {number} simulationId
 * @param {number} componentId
 * @param {number} x
 * @param {number} y
 * @returns {Record<any, number>}
 * */
export const updateSimulationComponent = async (simulationId, componentId, x, y) => {
    const response = await fetch(`/api/simulation/${simulationId}/component?componentId=${componentId}&x=${x}&y=${y}`, {
        method: 'PUT'
    });
    const json = await response.json();
    console.log(json);
}
