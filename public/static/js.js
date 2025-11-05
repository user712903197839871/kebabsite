/**********************************************************************\
*                                                                      *
*              changing workers, rendering workers logic               *
*                                                                      *
\**********************************************************************/

// workers is a variable that is defined in our_workers.php and contains workers result from database

// which indexes we're showing, will be modified
let showing = [0, 1, 2];
let maxSize = workers["result"].length;

// inital
// rendering workers according to which ones we should show
function renderWorkers() {
    // the section that contains everything
    const workerSectionContainer = document.getElementById("workers-container");
    workerSectionContainer.innerHTML = "";

    // if the querrying failed
    if (!workers["success"]) {
        alert("no workers :(");
        console.log("no workers here either :(");
        // no workers or smthn
        const errorText = document.createElement("p");
        errorText.textContent = "No workers!";
        workerSectionContainer.appendChild(errorText);
    } else {
        // creating each element and appending it acordingly to it's necesary parrents
        // for an easier view see the dev tools on browser
        const ourWorkersText = document.createElement("h1");
        ourWorkersText.textContent = "Our Workers!";
        ourWorkersText.className = "center-text";

        workerSectionContainer.appendChild(ourWorkersText);
    
        const workersContents = document.createElement("div");
        workersContents.className = "our-workers";
        workersContents.innerHTML = "";

        const buttonLeft = document.createElement("button");
        buttonLeft.textContent = "<";
        buttonLeft.id = "change-workers-left";
        if (showing[0] == 0) buttonLeft.className = "change-worker-button-inactive";
        else buttonLeft.className = "change-worker-button";
        buttonLeft.addEventListener("click", moveWorkersLeft);

        workersContents.appendChild(buttonLeft);

        showing.forEach(index => {
            const workersDiv = document.createElement("div");
            workersDiv.className = "workers-container";

            const workerWrapperDiv = document.createElement("div");
            workerWrapperDiv.className = "worker";

            const workerName = document.createElement("h1");
            workerName.textContent = workers["result"][index]["Name"];

            const workerImage = document.createElement("img");
            workerImage.src = "./../" + workers["result"][index]["ImageUrl"];
            workerImage.alt = "image of " + workers["result"][index]["Name"];
            workerImage.className = "worker-image";

            const workerImageContainer = document.createElement("div");
            workerImageContainer.className = "worker-image-container";
            workerImageContainer.appendChild(workerImage);

            const workerAge = document.createElement("p");
            workerAge.textContent = "Age: " + workers["result"][index]["Age"];

            const workerDescription = document.createElement("p");
            workerDescription.textContent = workers["result"][index]["About"]


            workerWrapperDiv.appendChild(workerName);
            workerWrapperDiv.appendChild(workerImageContainer);
            workerWrapperDiv.appendChild(workerAge);
            workerWrapperDiv.appendChild(workerDescription);

            workersDiv.appendChild(workerWrapperDiv);

            workersContents.appendChild(workersDiv);
        });

        const buttonRight = document.createElement("button");
        buttonRight.textContent = ">";
        if (showing[2] + 1 == maxSize) buttonRight.className = "change-worker-button-inactive";
        else buttonRight.className = "change-worker-button";
        buttonRight.addEventListener("click", moveWorkersRight);

        workersContents.appendChild(buttonRight);

        workerSectionContainer.appendChild(workersContents);
    }
};

function moveWorkersRight() {
    if (showing[2] + 1 < maxSize) {
        showing[0]++; showing[1]++; showing[2]++;
    }
    renderWorkers();
}


function moveWorkersLeft() {
    if (showing[0] > 0) {
        showing[0]--; showing[1]--; showing[2]--;
    }
    renderWorkers();
}


// initial rendering of workers
renderWorkers();