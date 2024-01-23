class TableScript{
    
    baseUrl = 'http://localhost/api.php?';
    loader  = '<div class="loader"> <div class="spinner-border text-info" role="status"></div> </div>';
    data;
    tableContainer;

    constructor( {tableContainer, tableBody} ) {
        this.tableContainer = tableContainer;
        this.init();
    }

    init = async () => {
        this.data = await this.request({ endpoint:'operation=getAllBooks', options:{ method:'GET' } });
        this.renderTable();
    }

    request = async ({endpoint, options}) => {
        this.loaderRender();
        const request = await fetch(this.baseUrl+endpoint, {...options});
        const response = await request.json();
        this.loaderRender(0);
        return response.data;
    }

    renderTable = () => {

        let render = '<table id="example" class="display" style="width:100%;"><thead><tr><th>ID</th><th>Kitap Adı</th>';
        render = render + '<th>Sayfa Sayısı</th><th>Basım Tarihi</th><th>Kategorisi</th></tr> </thead><tbody> ';

        this.data.forEach( data => {
            render = render + '<tr>';
            render = render + '<td>' + data.id             + '</td>'; 
            render = render + '<td>' + data.book_name      + '</td>'; 
            render = render + '<td>' + data.page_count     + '</td>'; 
            render = render + '<td>' + data.release_date   + '</td>'; 
            render = render + '<td>' + data.category_name  + '</td>'; 
            render = render + '</tr>';
        });
        render = render + '</tbody > </table>';

        this.tableContainer.innerHTML = render;

        new DataTable('#example', {
            paging: true,
            scrollCollapse: true,
            scrollY: '400px',
        });
    }

    loaderRender = ( state = 1 ) => {
        // state 1 için loader ekler 0 için loader siler
        if (state === 1) {
            this.tableContainer.insertAdjacentHTML('afterbegin', this.loader);
        }
        else if(document.querySelector('.loader')){
            document.querySelector('.loader').remove();
        }
    }

}

new TableScript({tableContainer:document.getElementById('tableContainer')});