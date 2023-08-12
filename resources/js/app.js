import "./bootstrap";

import Alpine from "alpinejs";

window.Alpine = Alpine;

Alpine.start();

import Plyr from "plyr";

const player = new Plyr("audio", {});
// const player = new Plyr('#player');
// Expose player so it can be used from the console
window.player = player;

console.log("after player");
// let event = new Event("hello", {bubbles: true}); // (2)
// window.player.dispatchEvent(event);

player.on("ready", (event) => {
    const instance = event.detail.plyr;
    console.log("inside ready");
    document.dispatchEvent(new Event("Pready", { bubbles: true }));
    // tryPlay(player);
    // setTimeout(() => {
    // }, 1000); // Adjust the delay as needed
});
player.on("play", (event) => {
    const instance = event.detail.plyr;
    console.log("inside play");
    document.dispatchEvent(new Event("Pplay", { bubbles: true }));
});
player.on("pause", (event) => {
    const instance = event.detail.plyr;
    console.log("inside pause");
    document.dispatchEvent(new Event("Ppause", { bubbles: true }));
});

function tryPlay(player) {
    var playPromise = player.play();
    console.log("inside try");

    if (playPromise != undefined) {
        playPromise
            .then((_) => {
                console.log("Started playing");
            })
            .catch((error) => {
                console.error("Error while trying to play:", error);
                // Retry by calling the function recursively after a delay
                setTimeout(() => {
                    tryPlay(player);
                }, 100); // Adjust the delay as needed
            });
    } else {
        console.log("shi teni");
    }
}
