function validar_adicional()
{
    var rta = []
    var idescu = parseInt($('#escuela').val())
    rta['estado'] = 0
    rta['msn'] = 'Error'
    rta['met'] = 'docentestutores'

    if(idescu >0)
    {
        var $post = {};
        $post._token = $('meta[name="csrf-token"]').attr('content');
        $post._idescuela = idescu
        rta['estado'] = 1
        rta['msn'] = $post
    }

    return rta
}