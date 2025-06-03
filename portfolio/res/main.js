let port_items = [];
let port_filters = [];

window.onload = () => {
    initPage();
}

window.addEventListener('scroll',el => {
    let scrollamt = Math.floor(window.scrollY);
    let theclass = scrollamt >= 100 ? 'scrolled' : '';

    navbar.className = theclass;
})

function initPage() {
    console.log("i am alive");

    // portfolio_area.style.backgroundColor = "red";
    port_items = portfolio_area.querySelectorAll('.portfolio-item');
    port_filters = portfolio_filters.querySelectorAll('.filter-btn');

    port_filters.forEach(el => {
        el.addEventListener('click',() => {
            port_filters.forEach(el2 => {el2.classList.remove("active")});
            el.classList.add("active");

            port_items.forEach(item => {
                if(item.dataset.category == el.dataset.filter || el.dataset.filter=="all"){
                    item.style.display = "block";
                } else {
                    item.style.display = "none";
                }
            })
        })
    })
}

