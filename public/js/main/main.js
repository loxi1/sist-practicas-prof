function datetoing(fec)
{
    var fec = fec.split("/");
    var fe_in = new Date(fec[2], fec[1] - 1, fec[0]);
    return moment(fe_in).format("YYYY-MM-DD");
}