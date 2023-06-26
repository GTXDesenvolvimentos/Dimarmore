<style>
    [data-tooltip] {
        position: relative;
       
        z-index: 5;

    }

    [data-tooltip]:after {
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

    [data-tooltip]:hover:after {
        display: block;
        z-index: 5;
    }
</style>

<div id="viewDashboard"></div>