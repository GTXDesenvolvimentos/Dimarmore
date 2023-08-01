<style>
    [data-tooltip] , [tooltip] {
        position: relative;
       
        z-index: 5;

    }

    [tooltip]:after {
        display: none;
        position: absolute;
        top: -20px;
        font-size: 10px;
        padding: 5px;
        right: calc(-200% + 1px);
        content: attr(tooltip);
        white-space: nowrap;
        background-color: darkgreen;
        color: White;
        z-index: 5;
    }

    [data-tooltip]:after {
        font-family: 'Font Awesome 6 Free';
        display: none;
        position: absolute;
        top: -20px;
        font-size: 10px;
        padding: 5px;
        right: calc(-100% + 1px);
        content: attr(data-tooltip);
        white-space: nowrap;
        background-color: darkgreen;
        color: White;
        z-index: 5;
    }

    [data-tooltip]:hover:after, [tooltip]:hover:after {
        display: block;
        z-index: 5;
    }

    a, i{
        cursor:pointer;
    }

    .fundo{
        background: #33414e;
        border: #33414e;
    }

    body, html {
        background: #33414e;
        overflow-x: hidden;
    }
</style>

<div id="viewQuadroTarefas"></div>


