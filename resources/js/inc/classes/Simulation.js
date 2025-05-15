export default class Simulation {

    /** @type {number} */
    #id;
    get id() { return this.#id; }

    /**
     * Create a new Simulation with the specified id.
     * @param {number} id Simulation id
     * */
    constructor(id) {
        this.#id = id;
    }

    /**
     * Add a component to a simulation at the specified position.
     * @param {number} componentId
     * @param {number} x
     * @param {number} y
     * @param {(success: boolean, data: Record<string, any>) => any} callback
     */
    async addComponentAtPosition(componentId, x, y, callback) {
        const response = await fetch(
            `/api/simulation/${this.#id}/component?id=${componentId}&x=${x}&y=${y}`,
            { method: 'POST' }
        );
        const json = await response.json();

        if (!response.ok) {
            console.error(json.error);
            return;
        }

        if (callback) callback(response.ok, json.data);
    }

    /**
     * Update the position of a component in the simulation.
     * @param {number} originX
     * @param {number} originY
     * @param {number} destinationX
     * @param {number} destinationY
     * @param {(success: boolean, data: Record<string, any>) => any} callback
     */
    async updateComponentPosition(originX, originY, destinationX, destinationY, callback) {
        const response = await fetch(
            `/api/simulation/${this.#id}/component?originX=${originX}&originY=${originY}&destX=${destinationX}&destY=${destinationY}`,
            { method: 'PATCH' }
        );
        const json = await response.json();

        if (!response.ok) {
            console.error(json.error);
            return;
        }

        if (callback) callback(response.ok, json.data);
    }

    /**
     * Deletes a component found at the specified position from the simulation.
     * @param {number} x
     * @param {number} y
     * @param {(success: boolean, data: Record<string, any>) => any} callback
     */
    async deleteComponentAtPosition(x, y, callback) {
        const response = await fetch(
            `/api/simulation/${this.#id}/component?x=${x}&y=${y}`,
            { method: 'DELETE' }
        );
        const json = await response.json();

        if (!response.ok) {
            console.error(json.error);
            return;
        }

        if (callback) callback(response.ok, json.data);
    }
}
