import './bootstrap';

import Simulation from './inc/classes/Simulation.js';
import { initializeDragAndDropListeners } from './inc/component-handler.js';

const simulation = new Simulation(1);

initializeDragAndDropListeners(simulation);
