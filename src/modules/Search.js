import $ from 'jquery'
class Search {
    constructor() {
        this.searchIcon = $('.courses_search')
        this.closeIcon = $('.search_closeicon')
        this.searchOverlay = $('#search__overlay')
        this.events()
    }
    events() {
        this.searchIcon.on('click', this.SearchOverlayState.bind(this))
        this.closeIcon.on('click', this.SearchOverlayState.bind(this))
    }
    SearchOverlayState() {
        this.searchOverlay.toggle('normal')
        $('body').toggleClass('overflow__hidden')
    }
}
export default Search