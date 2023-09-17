function get_values_form_elements(element,exclude){
    const form = get_element(element);
    const form_data = new FormData(form);
    const inputs = form.querySelectorAll('input , select, textarea');
    let empty_field = false;
    
    
    inputs.forEach(input => {
        if(input.value == ""){
            if(!exclude.includes(input.id)){
                empty_field = true;
            }
        }
    });
    return {form_data,empty_field};
}

const execute_fetch = async(url,data) => {
    try {
        const response = await fetch(url, {
            method: 'POST',
            body: data,
        });
        const json = await response.json();
        return json;
    } catch (error) {
        console.log(error);
        return null;
    }
}

function get_element(element){
    return document.getElementById(element);
}

function open_modal(modal){
    $(`#${modal}`).modal({backdrop: 'static', keyboard: false})
}

function insert_html(html,element){
    document.getElementById(element).innerHTML = html;
}