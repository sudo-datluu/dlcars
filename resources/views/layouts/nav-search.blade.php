@section('nav-search')
<div class="d-flex input-group w-auto">
    <input id="autoComplete" type="search" dir="ltr" spellcheck=false autocorrect="off" autocomplete="off" autocapitalize="off" maxlength="2048" tabindex="1">
</div>
@endsection

@section('search-script')
<script>
    const history = [];

    const autoCompleteJS = new autoComplete({
        selector: "#autoComplete",
        data: {
            src: async () => {
                try {
                    // Loading placeholder text
                    document
                        .getElementById("autoComplete")
                        .setAttribute("placeholder", "Loading...");
                    // Fetch External Data Source
                    const source = await fetch(
                        "/search/cars"
                    );
                    const data = await source.json();
                    // Post Loading placeholder text
                    document
                        .getElementById("autoComplete")
                        .setAttribute("placeholder", autoCompleteJS.placeHolder);
                    // Returns Fetched data
                    return data.map(car=> car.name);
                } catch (error) {
                    return error;
                }
            },
            key: ["name"],
            cache: true,
        },
        placeHolder: "Search for Cars...",
        trigger: (query) => {
            return true
        },
        resultsList: {
            element: (list, data) => {
                const info = document.createElement("p");
                if (data.results.length > 0) {
                    info.innerHTML = `Displaying <strong>${data.results.length}</strong> out of <strong>${data.matches.length}</strong> results`;
                } else {
                    info.innerHTML = `Found <strong>${data.matches.length}</strong> matching results for <strong>"${data.query}"</strong>`;
                }
                info.setAttribute("class", "text-center");
                list.prepend(info);
                const recentSearch = ["No Recent Searches Found"] || history.reverse();
                const historyLength = recentSearch.length;

                // Check if there are recent searches
                const historyBlock = document.createElement("div");
                historyBlock.setAttribute("style", "display: flex; flex-direction: column; margin: .3rem; padding: .3rem .5rem;");
                // Limit displayed searched to only last "2"

                recentSearch.slice(0, 2).forEach((item) => {
                    const recentItem = document.createElement("span");
                    recentItem.setAttribute("style", "display: flex; margin: .2rem; color: rgba(0, 0, 0, .2);");
                    recentItem.innerHTML = item;
                    historyBlock.append(recentItem);
                });

                const separator = document.createElement("hr");
                separator.setAttribute("style", "margin: 5px 0 0 0;");
                historyBlock.append(separator);

                list.prepend(historyBlock);
            },
            noResults: true,
            maxResults: 5,
            tabSelect: true
        },
        resultItem: {
            element: (item, data) => {
                // Modify Results Item Style
                item.style = "display: flex; justify-content: space-between;";
                // Modify Results Item Content
                item.innerHTML = `
                <span style="text-overflow: ellipsis; white-space: nowrap; overflow: hidden;">
                    ${data.match}
                </span>`;
            },
            highlight: true
        },
        events: {
            input: {

                focus: (event) => {
                    autoCompleteJS.start();
                }
            }
        }
    });
</script>
@endsection