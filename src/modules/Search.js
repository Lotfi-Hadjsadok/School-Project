import $ from 'jquery'
class Search {
    constructor() {
        this.searchIcon = $('.courses_search')
        this.closeIcon = $('.search_closeicon')
        this.searchOverlay = $('.search__overlay')
        this.searchInput = $('.search__input')
        this.spinner = $('.spinner')
        this.searchResultsTitle = $('.search__results-title')
        this.searchResultsTitle.hide()
        this.spinner.hide()
        this.timeout
        this.searchResults = $('.search__results-cards')
        this.events()
    }
    events() {

        $(document).on('click', '.search__results-card', this.vistiCourse.bind(this))
        this.searchIcon.on('click', this.searchOverlayState.bind(this))
        this.closeIcon.on('click', this.searchOverlayState.bind(this))
        this.searchInput.on('keyup', this.getData.bind(this))
    }
    searchOverlayState() {
        this.searchOverlay.toggle('normal')
        $('body').toggleClass('overflow__hidden')
    }
    vistiCourse() {
        let searchCard = $('.search__results-card')
        let post_link = searchCard.data('link')
        window.location.replace(post_link)
    }
    getData() {
        clearTimeout(this.timeout)
        this.spinner.show()
        this.timeout = setTimeout(() => {
            if (this.searchInput.val() == '') {
                this.searchResults.html('')
                this.searchResultsTitle.hide()
                this.spinner.hide()
                return
            }
            $.getJSON('http://school.local/wp-json/university/v1/courses?query=' + this.searchInput.val()).then(
                result => {
                    if (result.length == 0) {
                        this.searchResults.html('')
                        this.searchResultsTitle.hide()
                        this.spinner.hide()
                        return
                    }
                    this.spinner.hide()
                    this.searchResultsTitle.show()
                    this.searchResults.html(
                        result.map(post => `
                        <button data-link='${post.post_link}' class="search__results-card">
                        <h2>${post.title}</h2>
                        <div>
                           <a href='${post.module?.permalink}'><p>${post.module?.name || 'module'}</p></a>
                            <a href='${post.type?.permalink}'><p>${post.type?.name || 'type'}</p></a>
                            <a href='${post.faculty?.permalink}'><p>${post.faculty?.name || 'faculty'}</p></a>
                        </div>
                    </button>
                        `)
                    )

                }
            )
        }, 700);

    }

}
export default Search