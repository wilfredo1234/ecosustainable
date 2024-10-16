document.addEventListener('DOMContentLoaded', function() {
    const sitios = [
        {
            nombre: 'Ecoembes',
            descripcion: 'Organización medioambiental dedicada a la gestión del reciclaje y el ecodiseño de los envases en toda España.',
            enlace: 'https://www.ecoembes.com/es'
        },
        {
            nombre: 'Greenpeace',
            descripcion: 'Organización ecologista que lucha por proteger y defender el medio ambiente.',
            enlace: 'https://www.greenpeace.org/espana/'
        },
        {
            nombre: 'WWF',
            descripcion: 'Organización mundial de conservación que trabaja en temas de biodiversidad y sostenibilidad.',
            enlace: 'https://www.wwf.es/'
        },
        {
            nombre: 'Earth911',
            descripcion: 'Proporciona una base de datos de reciclaje donde los usuarios pueden encontrar centros de reciclaje locales.',
            enlace: 'https://earth911.com/'
        },
        {
            nombre: 'Reciclario',
            descripcion: 'Plataforma educativa que ofrece información y recursos sobre reciclaje y gestión de residuos.',
            enlace: 'https://www.reciclario.com/'
        }
    ];

    let sitiosContainer = document.getElementById('sitios');
    sitios.forEach(sitio => {
        let sitioDiv = document.createElement('div');
        sitioDiv.classList.add('sitio');
        sitioDiv.innerHTML = `
            <h3>${sitio.nombre}</h3>
            <p>${sitio.descripcion}</p>
            <a href="${sitio.enlace}" target="_blank">Visitar sitio</a>
        `;
        sitiosContainer.appendChild(sitioDiv);
    });
});
