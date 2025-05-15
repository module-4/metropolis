/** @typedef {{ error: string }} ErrorResponse */

/**
 * @typedef {{
 *     neighbors: Array<{
 *          id: number,
 *          x: number,
 *          y: number,
 *          effects: Array<Record<string, string>>
 *     }>
 * } | ErrorResponse} MultipleNeighborsResponse
 */

export default class Simulation {

    /** @type {number} */
    #id;
    get id() { return this.#id; }

    #neighborCache = new Map();

    /**
     * Create a new Simulation with the specified id.
     * @param {number} id Simulation id
     * */
    constructor(id) {
        this.#id = id;
        this.invalidateCache();
    }

    invalidateCache() {
        this.#neighborCache = Array.from({ length: 4 }, () =>
            Array.from({ length: 3 }, () => null)
        );
    }

    /**
     * Get neighbors of a component in a simulation based on the specified position.
     * @param {number} x
     * @param {number} y
     * @param {(success: boolean, data: MultipleNeighborsResponse) => any} callback
     */
    async getNeighborsFromPosition(x, y, callback) {
        const cachedData = this.#neighborCache[x]?.[y];
        if (cachedData) {
            if (callback) callback(true, cachedData);
            return;
        }
        const response = await fetch(
            `/api/simulation/${this.#id}/neighbors?x=${x}&y=${y}`,
            { method: 'GET' }
        );
        const json = await response.json();

        if (!response.ok) {
            console.error(json.error);
            return;
        }

        this.#neighborCache[x][y] = json.data;
        if (callback) callback(response.ok, json.data);
    }

    /**
     * Add a component to a simulation at the specified position.
     * @param {number} id Component id
     * @param {number} x
     * @param {number} y
     * @param {(success: boolean, data: { effects: Record<string, any> }|ErrorResponse) => any} callback
     */
    async addComponentAtPosition(id, x, y, callback) {
        const response = await fetch(
            `/api/simulation/${this.#id}/component?id=${id}&x=${x}&y=${y}`,
            { method: 'POST' }
        );
        const json = await response.json();

        if (!response.ok) {
            console.error(json.error);
            return;
        }

        this.invalidateCache();
        if (callback) callback(response.ok, json.data);
    }

    /**
     * Update the position of a component in the simulation.
     * @param {number} originX
     * @param {number} originY
     * @param {number} destinationX
     * @param {number} destinationY
     * @param {(success: boolean, data: Record<string, any>|ErrorResponse) => any} callback
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

        this.invalidateCache();
        if (callback) callback(response.ok, json.data);
    }

    /**
     * Deletes a component found at the specified position from the simulation.
     * @param {number} x
     * @param {number} y
     * @param {(success: boolean, data: Record<string, any>|ErrorResponse) => any} callback
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

        this.invalidateCache();
        if (callback) callback(response.ok, json.data);
    }
}
