document.addEventListener('DOMContentLoaded', function () {
    const readMoreBtns = document.querySelectorAll('.read-more-btn');

    readMoreBtns.forEach(btn => {
        btn.addEventListener('click', function () {
            const content = this.parentElement;
            const shortText = content.querySelector('.short-text');
            const longText = content.querySelector('.long-text');

            if (longText.style.display === 'none' || longText.style.display === '') {
                longText.style.display = 'block';
                shortText.style.display = 'none';
                this.textContent = 'Read Less';
            } else {
                longText.style.display = 'none';
                shortText.style.display = 'block';
                this.textContent = 'Read More';
            }
        });
    });
});

function filterContent() {
    const input = document.getElementById('searchInput');
    const filter = input.value.toLowerCase();
    const rows = document.querySelectorAll('.row');

    rows.forEach(row => {
        // Reset any previous highlights
        const elementsToHighlight = row.querySelectorAll('h3, .short-text, .long-text');
        elementsToHighlight.forEach(el => {
            el.innerHTML = el.textContent; // remove previous <mark>
        });

        const text = row.textContent.toLowerCase();

        if (text.indexOf(filter) > -1 && filter.trim() !== '') {
            row.style.display = "";

            // Highlight keyword
            elementsToHighlight.forEach(el => {
                const regex = new RegExp(`(${filter})`, 'gi');
                el.innerHTML = el.textContent.replace(regex, '<mark>$1</mark>');
            });
        } else if (filter.trim() === '') {
            row.style.display = "";
        } else {
            row.style.display = "none";
        }
    });
}


function toggleSearch() {
    const searchInput = document.createElement('input');
    searchInput.type = 'text';
    searchInput.id = 'searchInput';
    searchInput.placeholder = 'Search...';
    searchInput.onkeyup = filterContent;
    searchInput.style.padding = '10px';
    searchInput.style.fontSize = '1.6rem';
    searchInput.style.border = '1px solid #ccc';
    searchInput.style.borderRadius = '5px';
    searchInput.style.marginLeft = '1rem';

    const navbar = document.querySelector('.search-bar');
    const existingInput = document.getElementById('searchInput');

    if (existingInput) {
        navbar.removeChild(existingInput);
    } else {
        navbar.appendChild(searchInput);
    }
}