import './bootstrap';

import Simulation from './inc/classes/Simulation.js';
import {initializeDragAndDropListeners, initializeHoverListeners} from './inc/component-handler.js';

// Using simulation with id 1 until saving is properly implemented
const simulation = new Simulation(1);

initializeDragAndDropListeners(simulation);
initializeHoverListeners(simulation);