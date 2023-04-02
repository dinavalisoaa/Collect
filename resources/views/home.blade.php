<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>home - <?php echo $id ?> </title>
</head>
<body>
    <h2>suggestion amis</h2>
        <?php foreach ($list_members as $list ) 
        { ?>
            <p><?php echo $list -> nom ?> <a href="<?php echo url('traite/demand'); ?>?id_rejoin=<?php echo $list -> id_mb?>">rejoin</a></p>
        <?php } ?>
    <br>    
    <h2>demand envoyer</h2>
        <?php foreach ($list_demand_envoyer as $list ) 
        { 
            $idd = $list -> id_mb;
            ?>
            <p><?php echo $list -> nom ?> <a href="<?php echo url('traite/annuler'); ?>?id_annuler=<?php echo $list -> id_mb?>">annuler</a></p>
        <?php } ?>
<!--  -->
    <br>    
    <h2>invitation</h2>  
    <?php foreach ($list_demand_recu as $list) 
    { ?>
      <p><?php echo $list -> nom; ?> <a href="<?php echo url('traite/accept'); ?>?id_accept=<?php echo $list -> id_mb ?>">accept</a>  <a echo href="<?php echo url('traite/delete'); ?>?id_delete=<?php echo $list -> id_mb ?>">delete</a></p>  
    <?php } ?>
    <br>    
    <h2>list amis</h2>  
    
    <?php foreach ($list_amis as $list) 
        { ?>
            <p>
                <form action="<?php echo url('traite/message'); ?>"  method="post">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="id_receiver" value ="<?php echo $list -> id_mb ?>">
                    <?php echo $list -> nom; ?>     
                    <button type="submit">message</button>
                </form>
            </p>  
        <?php 
        } ?>

    <h2>publications</h2>
        <form action="<?php echo url('traite/publication'); ?>" method="post">
            @csrf 
            @method('PUT')
            <div>
                <select name="audience" id="">
                    <option>change your audience</option>
                    <option value="public">public</option>
                    <option value="amis">amis</option>
                    <option value="moi">moi uniquement</option>
                </select>
            </div>
            <div>
                <textarea class = "create" name="description" id="" cols="auto" rows="auto" placeholder="what's on your mind?" required ></textarea>
            </div>
            <input type="submit" value="Post">
        </form>

        <div>
            <?php foreach ($list_publications as $key) { ?>
                <form action="<?php echo url('set/reaction'); ?>" method="post">
                    @csrf
                    @method('PUT')
                    <div> 
                        <p> {{ $key -> typeaffiche }} </p>                 
                        <h4> {{ $key -> articlepub }} </h4>   
                        <input type="hidden" name="idPublication" value="{{ $key -> id_pub }}"> 
                        <select name="typereact" id="">
                            <option>reaction</option>
                            <?php foreach ($list_reactions as $key) { ?>
                                <option value="{{ $key -> id_react }}">{{ $key -> nom_reaction }}</option>
                            <?php } ?>
                        </select>
                        <input type="submit" value="reagir">
                    </div>
                </form>
            <?php } ?>
        </div>
</body>
</html>