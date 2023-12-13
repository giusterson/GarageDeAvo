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
        console.log('toto');
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
            })
        })
    } 
}