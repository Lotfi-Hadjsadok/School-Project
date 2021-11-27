import $ from 'jquery'
class Search {
    constructor() {
        this.searchIcon = $('.courses_search')
        this.closeIcon = $('.search_closeicon')
        this.searchOverlay = $('.search__overlay')
        this.searchInput = $('.search__input')
        this.timeout
        this.searchResults = $('.search__results-cards')
        this.events()
    }
    events() {
        this.searchIcon.on('click', this.searchOverlayState.bind(this))
        this.closeIcon.on('click', this.searchOverlayState.bind(this))
        this.searchInput.on('keyup', this.getData.bind(this))
    }
    searchOverlayState() {
        this.searchOverlay.toggle('normal')
        $('body').toggleClass('overflow__hidden')
    }
    getData() {

        clearTimeout(this.timeout)
        this.timeout = setTimeout(() => {
            $.getJSON('http://school.local/wp-json/university/v1/courses?query=' + this.searchInput.val()).then(
                result => {
                    this.searchResults.html(
                        result.map(post => `
                        <div class="search__results-card">
                        <h2>${post.title}</h2>
                        <div>
                           <a href='${post.module?.permalink}'><p>${post.module?.name || 'module'}</p></a>
                            <a href='${post.type?.permalink}'><p>${post.type?.name || 'type'}</p></a>
                            <a href='${post.faculty?.permalink}'><p>${post.faculty?.name || 'faculty'}</p></a>
                        </div>
                    </div>
                        `)
                    )

                }
            )
        }, 1000);

    }

}
export default Search