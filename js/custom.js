
function async_query(file, async, data, type) {
    const deferred = $.Deferred();
    const path = file+async;
    const objData = {
        data: data,
        type: type
    };

    $.post(path, objData, function(response) {

        const parse = $.parseJSON(response);

        if(parse['STATUS'] == 'ok') {
            deferred.resolve(response);
        } else {
            deferred.reject(['ERROR']);
        }
    })

    return deferred.promise();
}