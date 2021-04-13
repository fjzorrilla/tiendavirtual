<style type="text/css">
   .img_redond{
  border-radius: 50%;
  max-width: 200px;
}
</style>
<section id="" class="">
  <div class="container">
    <br>
    <div class="row">
      <div class="col-md-2 text-center">
      </div>
      <div class="col-md-4 text-center">
           <div class=" text-center" style="position: relative;z-index: 3">
          <a href="#"><img class="img_redond" src="{{ asset('img/perro.png') }}" title="Perro"></a>
        </div>
      </div>
     <div class="col-md-4 text-center">
           <div class=" text-center" style="position: relative;z-index: 3">
          <a href=""><img class="img_redond" src="{{ asset('img/perro.png') }}" title="Gato"></a>
        </div>
     </div>
     <div class="col-md-2 text-center">

      </div>
    </div>
  </div>
</section>
<script type="text/javascript">
  $(".seguros-one").hover(function(){
      $("#overlayone").show("slow");
  },function(){
      $("#overlayone").hide("slow");
  });
  $(".seguros-two").hover(function(){
      $("#overlaytwo").show("slow");
  },function(){
      $("#overlaytwo").hide("slow");
  });
  $(".seguros-three").hover(function(){
      $("#overlaythree").show("slow");
  },function(){
      $("#overlaythree").hide("slow");
  });
  $(".seguros-four").hover(function(){
      $("#overlayfour").show("slow");
  },function(){
      $("#overlayfour").hide("slow");
  });


</script>