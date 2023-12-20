/**
 * @property {HTMLElement|null} pagination
 * @property {HTMLElement|null} content
 * @property {HTMLElement|null} sorting
 * @property {HTMLElement|null} form
 */

export default class Filter {
    
    /**
     * 
     * @param {HTMLElement|null} element 
     */
    constructor(element) {
        if (element === null) {

        console.log('toto dans le if');

            return
        }
        console.log('je me construis');
        this.pagination = element.querySelector('.js-filter-pagination');
        this.content = element.querySelector('.js-filter-content');
        this.sorting = element.querySelector('.js-filter-sorting');
        this.form = element.querySelector('.js-filter-form'); 
        this.bindEvents();
    }

    
    /**
     * Ajouter les comportements au différents eléments.
     */
            
     bindEvents() {
        this.sorting.querySelectorAll('a').forEach(a => {
            a.addEventListener('click', e => {
                e.preventDefault()
                this.loadUrl(a.getAttribute('href'))
            })
        })
    } 

    async loadUrl (url) {
        const response = await fetch(url, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        // Condition pour que la requête s'est bien déroulée 
        if (response.status >= 200 && response.status > 300) {
            const data = await response.json()
            this.content.innerHTML = data.content
        } else {
            console.error(response)
        }
    }
}