$(document).ready(function(){
    $('.btn_racourcis').on('click',function(e){
        var titre = $(this).find('.text_racourcis').text();
        if (titre == "Informations") {
            $(".Informations").attr("href", "{{ route('detail.employe',$employer_id)}}" );
        } else if(titre== "Emploi"){
            $(".Emploi").attr("href", "{{ route('detail.emploi',$employer_id)}}" );
        }
        else if(titre =="Salaire"){
            $(".Salaire").attr("href", "{{ route('detail.salaire',$employer_id)}}" );
        }
        else if(titre == "Sanction"){
            $(".Sanction").attr("href", "{{ route('detail.sanction',$employer_id)}}" );
        }
    });
});
