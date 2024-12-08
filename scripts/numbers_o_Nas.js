document.addEventListener("DOMContentLoaded", () => {
    const counters = document.querySelectorAll(".stat-number");

    counters.forEach(counter => {
        const updateCount = () => {
            const target = +counter.getAttribute("data-target");
            const count = +counter.innerText;

            const increment = target / 100;

            if (count < target) {
                counter.innerText = Math.ceil(count + increment);
                if (target < 10){
                    setTimeout(updateCount, 250);

                }else{
                    setTimeout(updateCount, 20);
                }

            } else {
                counter.innerText = target;
            }
        };

        updateCount();
    });
});
