

const cards = document.querySelectorAll('.my-card');
const aosClasses = [ 'fade-up', 'fade-down', 'fade-right', 'fade-left', 'flip-left', 'zoom-in'];

if ( cards && typeof cards === 'object' && cards.length > 0 ) {
    cards.forEach( card => {
        card.setAttribute('data-aos', aosClasses[Math.floor(Math.random()*aosClasses.length)]);
    });
}