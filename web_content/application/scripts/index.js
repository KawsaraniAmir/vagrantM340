const sideMenu = document.querySelector('aside');
const menuBtn = document.getElementById('menu-btn');
const closeBtn = document.getElementById('close-btn');

const darkMode = document.querySelector('.dark-mode');

menuBtn.addEventListener('click', () => {
    sideMenu.style.display = 'block';
});

closeBtn.addEventListener('click', () => {
    sideMenu.style.display = 'none';
});

darkMode.addEventListener('click', () => {
    document.body.classList.toggle('dark-mode-variables');
    darkMode.querySelector('span:nth-child(2)').classList.toggle('active');
    darkMode.querySelector('span:nth-child(1)').classList.toggle('active');
})

/*
projects.forEach(projects => {
    const tr = document.createElement('tr');
    const trContent = `
        <td>${projects.name}</td>
        <td>${projects.number}</td>
        <td>${projects.members}</td>
        <td class="${projects.status === 'Canceled' ? 'danger' : projects.status === 'Paused' ? 'warning' : 'primary'}">${projects.status}</td>
        <td class="primary">Details</td>
    `;
    tr.innerHTML = trContent;
    document.querySelector('table tbody').appendChild(tr);
});
*/