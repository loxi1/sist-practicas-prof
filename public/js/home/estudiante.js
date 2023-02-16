function validar_adicional()
{
    var rta = []
    var idcarr = parseInt($('#carrera').val())
    rta['estado'] = 0
    rta['msn'] = 'Error'
    rta['met'] = 'estudiantes'

    if(idcarr >0)
    {
        var $post = {};
        $post._token = $('meta[name="csrf-token"]').attr('content');
        $post._idcarrera = idcarr
        rta['estado'] = 1
        rta['msn'] = $post
    }

    return rta
}