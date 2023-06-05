    <script src="<?= base_url('/assets/vendor/jquery/jquery.min.js') ?>"></script>
    <script src="<?= base_url('/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
    <script src="<?= base_url('/assets/vendor/jquery-easing/jquery.easing.min.js') ?>"></script>
    <script src="<?= base_url('/assets/js/sb-admin-2.min.js') ?>"></script>
    <script src="<?= base_url('/assets/vendor/chart.js/Chart.min.js') ?>"></script>
    <!-- <script src="<?= base_url('/assets/js/demo/chart-area-demo.js') ?>"></script> -->
    <!-- <script src="<?= base_url('/assets/js/demo/chart-pie-demo.js') ?>"></script> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdn.jsdelivr.net/npm/cleave.js@1.6.0/dist/cleave.min.js"></script>
    <script src="https://unpkg.com/tableexport.jquery.plugin/tableExport.min.js"></script>
    <script src="https://unpkg.com/bootstrap-table@1.21.4/dist/bootstrap-table.min.js"></script>
    <script src="https://unpkg.com/bootstrap-table@1.21.4/dist/extensions/export/bootstrap-table-export.min.js"></script>
    <script src="https://unpkg.com/bootstrap-table@1.21.4/dist/locale/bootstrap-table-pt-BR.min.js"></script>
    <script src="https://unpkg.com/bootstrap-table@1.21.4/dist/extensions/mobile/bootstrap-table-mobile.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.17/js/bootstrap-select.min.js" integrity="sha512-/xmIG37mK4F8x9kBvSoZjbkcQ4/y2AbV5wv+lr/xYhdZRjXc32EuRasTpg7yIdt0STl6xyIq+rwb4nbUmrU/1g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="<?= base_url('/assets/js/js.js') ?>"></script>




    <script>
        if (typeof module === 'object') {
            window.module = module;
            module = undefined;
        }
    </script>


    <script>
        if (window.module) module = window.module;
    </script>
    <script type="text/javascript">
        var _gaq = _gaq || [];
        _gaq.push(['_setAccount', 'UA-36251023-1']);
        _gaq.push(['_setDomainName', 'jqueryscript.net']);
        _gaq.push(['_trackPageview']);

        (function() {
            var ga = document.createElement('script');
            ga.type = 'text/javascript';
            ga.async = true;
            ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
            var s = document.getElementsByTagName('script')[0];
            s.parentNode.insertBefore(ga, s);
        })();

        //variables
        let cardBeignDragged;
        let dropzones = document.querySelectorAll('.dropzone');
        let priorities;
        let cards = document.querySelectorAll('.kanbanCard');
        let dataColors = [{
                color: "yellow",
                title: "Aguardando"
            },
            {
                color: "green",
                title: "Pendente"
            },
            {
                color: "blue",
                title: "Executando"
            },
            {
                color: "purple",
                title: "Concluido"
            },
        ];
        let dataCards = {
            config: {
                maxid: 0
            },
            cards: []
        };
        let theme = "light";
        //initialize

        $(document).ready(() => {
            $("#loadingScreen").addClass("d-none");
            theme = localStorage.getItem('@kanban:theme');
            if (theme) {
                $("body").addClass(`${theme==="light"?"":"darkmode"}`);
            }
            initializeBoards();
            if (JSON.parse(localStorage.getItem('@kanban:data'))) {
                dataCards = JSON.parse(localStorage.getItem('@kanban:data'));
                initializeComponents(dataCards);
            }
            initializeCards();
            $('#add').click(() => {
                const title = $('#titleInput').val() !== '' ? $('#titleInput').val() : null;
                const description = $('#descriptionInput').val() !== '' ? $('#descriptionInput').val() : null;
                $('#titleInput').val('');
                $('#descriptionInput').val('');
                if (title && description) {
                    let id = dataCards.config.maxid + 1;
                    const newCard = {
                        id,
                        title,
                        description,
                        position: "yellow",
                        priority: false
                    }
                    dataCards.cards.push(newCard);
                    dataCards.config.maxid = id;
                    save();
                    appendComponents(newCard);
                    initializeCards();
                }
            });




            $("#deleteAll").click(() => {
                dataCards.cards = [];
                save();
            });




            $("#theme-btn").click((e) => {
                e.preventDefault();
                $("body").toggleClass("darkmode");
                if (theme) {
                    localStorage.setItem("@kanban:theme", `${theme==="light"?"darkmode":""}`)
                } else {
                    localStorage.setItem("@kanban:theme", "darkmode")
                }
            });
        });

        //functions
        function initializeBoards() {
            dataColors.forEach(item => {
                let htmlString = `<div class="board"><h6 class="text-center">${item.title.toUpperCase()}</h6><div class="dropzone" id="${item.color}"></div></div>`;
                $("#boardsContainer").append(htmlString)
            });
            let dropzones = document.querySelectorAll('.dropzone');
            dropzones.forEach(dropzone => {
                dropzone.addEventListener('dragenter', dragenter);
                dropzone.addEventListener('dragover', dragover);
                dropzone.addEventListener('dragleave', dragleave);
                dropzone.addEventListener('drop', drop);
            });
        }

        function initializeCards() {
            cards = document.querySelectorAll('.kanbanCard');

            cards.forEach(card => {
                card.addEventListener('dragstart', dragstart);
                card.addEventListener('drag', drag);
                card.addEventListener('dragend', dragend);
            });
        }

        function initializeComponents(dataArray) {
            //create all the stored cards and put inside of the todo area
            dataArray.cards.forEach(card => {
                appendComponents(card);
            })
        }

        function appendComponents(card) {
            //creates new card inside of the todo area
            let htmlString = `
        <div id=${card.id.toString()} class="kanbanCard ${card.position}" draggable="true">
            <div class="content">               
                <h4 class="title">${card.title}</h4>
                <p class="description">${card.description}</p>
            </div>
            <form class="row mx-auto justify-content-between">
                <span id="span-${card.id.toString()}" onclick="togglePriority(event)" class="material-icons priority ${card.priority? "is-priority": ""}">
                    star
                </span>
                <button class="invisibleBtn">
                    <span class="material-icons delete" onclick="deleteCard(${card.id.toString()})">
                        remove_circle
                    </span>
                </button>
            </form>
        </div>
        <div id=${card.id.toString()} class="kanbanCard ${card.position}" draggable="true">
            <div class="content">               
                <h4 class="title">${card.title}</h4>
                <p class="description">${card.description}</p>
            </div>
            <form class="row mx-auto justify-content-between">
                <span id="span-${card.id.toString()}" onclick="togglePriority(event)" class="material-icons priority ${card.priority? "is-priority": ""}">
                    star
                </span>
                <button class="invisibleBtn">
                    <span class="material-icons delete" onclick="deleteCard(${card.id.toString()})">
                        remove_circle
                    </span>
                </button>
            </form>
        </div>`

            $(`#${card.position}`).append(htmlString);
            priorities = document.querySelectorAll(".priority");
        }

        function togglePriority(event) {
            event.target.classList.toggle("is-priority");
            dataCards.cards.forEach(card => {
                if (event.target.id.split('-')[1] === card.id.toString()) {
                    card.priority = card.priority ? false : true;
                }
            })
            save();
        }

        function deleteCard(id) {
            dataCards.cards.forEach(card => {
                if (card.id === id) {
                    let index = dataCards.cards.indexOf(card);
                    console.log(index)
                    dataCards.cards.splice(index, 1);
                    console.log(dataCards.cards);
                    save();
                }
            })
        }


        function removeClasses(cardBeignDragged, color) {
            cardBeignDragged.classList.remove('red');
            cardBeignDragged.classList.remove('blue');
            cardBeignDragged.classList.remove('purple');
            cardBeignDragged.classList.remove('green');
            cardBeignDragged.classList.remove('yellow');
            cardBeignDragged.classList.add(color);
            position(cardBeignDragged, color);
        }

        function save() {
            //console.log(JSON.stringify(dataCards))
            localStorage.setItem('@kanban:data', JSON.stringify(dataCards));
        }

        function position(cardBeignDragged, color) {
            const index = dataCards.cards.findIndex(card => card.id === parseInt(cardBeignDragged.id));
            dataCards.cards[index].position = color;
            save();
        }

        //cards
        function dragstart() {
            dropzones.forEach(dropzone => dropzone.classList.add('highlight'));
            this.classList.add('is-dragging');
        }

        function drag() {

        }

        function dragend() {
            dropzones.forEach(dropzone => dropzone.classList.remove('highlight'));
            this.classList.remove('is-dragging');
        }

        // Release cards area
        function dragenter() {

        }

        function dragover({
            target
        }) {
            this.classList.add('over');
            cardBeignDragged = document.querySelector('.is-dragging');
            if (this.id === "yellow") {
                removeClasses(cardBeignDragged, "yellow");

            } else if (this.id === "green") {
                removeClasses(cardBeignDragged, "green");
            } else if (this.id === "blue") {
                removeClasses(cardBeignDragged, "blue");
            } else if (this.id === "purple") {
                removeClasses(cardBeignDragged, "purple");
            } else if (this.id === "red") {
                removeClasses(cardBeignDragged, "red");
            }

            this.appendChild(cardBeignDragged);
        }

        function dragleave() {

            this.classList.remove('over');
        }

        function drop() {
            this.classList.remove('over');
        }
    </script>











    </body>

    </html>