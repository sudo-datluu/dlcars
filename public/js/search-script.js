const getHistory = async () => {
    try {
        const response = await fetch("/search/history");
        const data = await response.json();
        return data;
    } catch (error) {
        return error;
    }
};

function searchCars() {
    if ($("#autoComplete").val() === "") {
        return;
    }

    $.ajax({
        type: "POST",
        dataType: "json",
        url: "/search/save",
        data: {
            searchTerm: $("#autoComplete").val()
        }
    }).then(() => {
        window.location.href = "/home?query=" + $("#autoComplete").val();
    });
}

(
    async () => {
        const history = await getHistory();
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
                        const source = await fetch("/search/cars");
                        const data = await source.json();
                        // Post Loading placeholder text
                        document
                            .getElementById("autoComplete")
                            .setAttribute("placeholder", autoCompleteJS.placeHolder);
                        // Returns Fetched data
                        return data;
                    } catch (error) {
                        return error;
                    }
                },
                keys: ["name"],
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
                    const recentSearch = history;
                    const historyLength = recentSearch.length;
                    const historyBlock = document.createElement("div");
                    historyBlock.setAttribute("style", "display: flex; flex-direction: column; margin: .3rem; padding: .3rem .5rem;");
                    // Check if there are recent searches
                    historyBlock.innerHTML = history.length ? "Recent Searches" : "No Recent Searches Found";
                    // Limit displayed searched to only last "2"
                    recentSearch.slice(0, 3).forEach((item) => {
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
                    selection(event) {
                        const feedback = event.detail;
                        const inputValue = autoCompleteJS.input.value.toLowerCase();
                        const selection = feedback.selection.value;

                        if (inputValue) {
                            // Add selected value to "history" array
                            history.push(selection);
                            $.ajax({
                                type: "POST",
                                dataType: "json",
                                url: "/search/save",
                                data: {
                                    searchTerm: inputValue
                                }
                            }).then(() => {
                                window.location.href = "/car/" + selection.id;
                            });
                        } else {
                            window.location.href = "/car/" + selection.id;
                        }
                    },
                    focus: (event) => {
                        autoCompleteJS.start();
                    },
                    keydown(event) {
                        switch (event.keyCode) {
                            // Down/Up arrow
                            case 40:
                            case 38:
                                event.preventDefault();
                                // Move cursor based on pressed key
                                event.keyCode === 40 ? autoCompleteJS.next() : autoCompleteJS.previous();
                                break;
                            // Enter
                            case 13:
                                if (!autoCompleteJS.submit) event.preventDefault();

                                console.log(autoCompleteJS.cursor)
                                // If cursor moved
                                if (autoCompleteJS.cursor >= 0) {
                                    autoCompleteJS.select(event);
                                } else {
                                    // If no cursor
                                    searchCars()
                                }
                                break;
                            // Tab
                            case 9:
                                // Select on Tab if enabled
                                if (autoCompleteJS.resultsList.tabSelect && autoCompleteJS.cursor >= 0) autoCompleteJS.select(event);
                                break;
                            // Esc
                            case 27:
                                // Clear "input" value
                                autoCompleteJS.input.value = "";
                                autoCompleteJS.close();
                                break;
                        }
                    }
                }
            }
        });
    }
)();
