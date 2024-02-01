<div class="container my-2 py-2">
    <form action ="#" id="searchForm">
        <div class="row">
            <div class="d-flex justify-content-center mt-3  col">
                <input type="text" id="searchbar" aria-label="Cerca" placeholder="Cerca..." required/>
                <button type="submit" id="searchButton" class="btn btn-success ms-1">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                        <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                    </svg>
                </button>
            </div>
        </div>
        <div id="display" class="bg-light"></div>
    </form>
    <div class="row my-2">
        <div class="col d-flex">
            <div id="result" class="bg-light border border-dark py-2 px-3 my-1 rounded w-100">
                <ul id="result"></ul>
            </div>
        </div>
    </div>
</div>