document.addEventListener("DOMContentLoaded", function () {
    // Search bar functionality
    const searchInput = document.getElementById("search");
    const packages = document.querySelectorAll(".package");

    searchInput.addEventListener("input", function () {
        const searchTerm = searchInput.value.toLowerCase();

        packages.forEach((package) => {
            const packageName = package.querySelector("h3").textContent.toLowerCase();
            if (packageName.includes(searchTerm)) {
                package.style.display = "inline-block";
            } else {
                package.style.display = "none";
            }
        });
    });

    // Image error handling (Replace broken images with a default image)
    document.querySelectorAll(".package img").forEach((img) => {
        img.onerror = function () {
            this.src = "admin/img/default-image.jpg";
        };
    });

    // Smooth scrolling effect
    window.scrollTo({
        top: 0,
        behavior: "smooth",
    });
});
