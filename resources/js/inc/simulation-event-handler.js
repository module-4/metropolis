const simControlbarForm = document.getElementById('sim-controlbar-form')

let currentEvent = null
let started = false


if (simControlbarForm) {
    simControlbarForm.addEventListener("submit", async (e) => {
        e.preventDefault()

        const formData = new FormData(e.target);
        const action = e.submitter

        currentEvent = await JSON.parse(formData.get("event").toString())
        const duration = parseInt(formData.get("duration")) * 1000 //convert to seconds
        const iterating = formData.get("iterating")

        switch (action.value) {
            case "play":
                playEventSimulation( duration, iterating)
                break;
            case "stop":
                resetEventSimulation()
                break;
        }
    })
}

async function playEventSimulation( duration, iterating) {
    if (started) {
        return
    }else {
        started = true
    }

    const progressBar = document.getElementById('sim-event-progress')

    let showEventEffects = true;
    while (started) {
        progressBar.style.transition = "width 0s";
        progressBar.style.width = "0%";

        await new Promise(requestAnimationFrame);

        progressBar.style.transition = `width ${duration}ms linear`;
        progressBar.style.width = "100%";

        showEventEffects ?
        updateEventEffects(currentEvent.effects):
        removeEventEffects();

        showEventEffects = !showEventEffects;

        await new Promise(resolve => {
            setTimeout(resolve, duration)
        });

        if (!iterating) {
            // Break out of while loop
            started = false
        }
    }

    // Cleanup
    resetEventSimulation()
}

function resetEventSimulation() {
    //Break out of simulation
    started = false
    currentEvent = null

    const progressBar = document.getElementById('sim-event-progress')
    progressBar.style.transition = "width 0s";
    progressBar.style.width = 0;

    removeEventEffects()

    //remove effects that are added just for the event
    const effectsListElement = document.getElementById("sim-effects-list")
    const effectsArray = Array.from(effectsListElement.children)
    effectsArray.forEach((child) => {
        if (child.dataset.event) {
            child.remove()
        }
    })

    // recreate an empty state if there are no effects
    if (effectsListElement.children.length == 0){
       const emptyStateElement  = document.createElement("p")
        emptyStateElement.innerText = "No effects found"
        emptyStateElement.id="empty-state"
        effectsListElement.append(emptyStateElement)
    }
}

function removeEventEffects(){
    const effectsListElement = document.getElementById("sim-effects-list")
    const effectsArray = Array.from(effectsListElement.children)

    effectsArray.forEach((child) => {
        // The event effects element is always the second child
        const eventEffect = child.children[1]

        if (eventEffect) {
            eventEffect.textContent = ""
        }
    })
}

function updateEventEffects( action) {
    const effectsListElement = document.getElementById("sim-effects-list")
    const effectsArray = Array.from(effectsListElement.children)

   currentEvent.effects.forEach((effect) => {

       if (effectsListElement.children[0].id == "empty-state"){
           effectsListElement.children[0].remove()
       }

        let exists
        effectsArray.forEach((child) => {
            if (child.id == effect.name) {
                exists = true
                const eventEffectElement = child.children[1]

                if (effect.pivot.value == 0 || action == "stop") {
                    eventEffectElement.textContent = ""
                } else {
                    eventEffectElement.textContent = ` ${effect.pivot.value > 0 ? "+" : ""} ${effect.pivot.value}`
                }
            }
        })
        if (!exists && effect.pivot.value != 0) {
            const effectElement = document.createElement('div');
            effectElement.classList.add(
                'bg-white',
                'border',
                'border-gray-200',
                'px-4',
                'py-2',
                'rounded-md',
                'text-black',
                'flex',
                'gap-4'
            );
            effectElement.id = effect.name;
            effectElement.setAttribute("data-event", 'true')

            const simEffect = document.createElement('div');
            simEffect.textContent = `${effect.name}: 0`;

            const eventEffect = document.createElement('div');
            eventEffect.textContent = (effect.pivot.value > 0 ? "+":"")+ effect.pivot.value

            effectElement.append(simEffect);
            effectElement.append(eventEffect);
            effectsListElement.append(effectElement);
        }
    })

}

export {resetEventSimulation}
