<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
    <script>
        $( document ).ready(function() {
            $(".addEntry").click(function(){
                let name = prompt("Name:", "");
                if (name != null) {
                    $("#createEntryForm .entryLabel").val(name);
                    $("#createEntryForm").submit();
                    $("#createEntryForm").submit(function(){
                        location.reload();
                    });
                }
            });
            $(".editEntryLabel").click(function(){
				
                updateEntry($(this).closest("tr"),"label");
            });
            $(".entryValue").change(function(){
				
                updateEntry($(this).closest("tr"),"value");
            });
        });
		
        function updateEntry($tr,fieldToChange) {
			
            var id = $tr.attr("data-id");
			var name = $(".entryName",$tr).html();
			var value = $(".entryValue",$tr).val();
			
			if(fieldToChange=="label") {
				var newName = prompt("Name:", name);
			}
            
			if(fieldToChange=="label" && newName!=null){
				name = newName;
			}			
			
			$("#updateEntryForm .entryLabel").val(name);
			$("#updateEntryForm .entryValue").val(value);
			$("#updateEntryForm .entryId").val(id);
			
			$("#updateEntryForm").get(0).submit(function(e){
				$(".entryLabel",$tr).html(name);
				e.preventDefault();
			});
            
        }
    </script>
</head>
<body>
<div id="app">

    <main class="container">

        <h2>Add new field</h2>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form method="post" id="createEntryForm" action="{{route('entries.create')}}" style="display: none">
            @csrf
            @method('post')
            <input type="hidden" name="month" value="{{$month}}">
            <input type="hidden" name="year" value="{{$year}}">
            <input type="hidden" name="label" class="entryLabel">
            <input type="hidden" name="type" value="1">
        </form>
        <hr>
        <form method="post" id="updateEntryForm" action="{{route('entries.update')}}" style="display: none">
            @csrf
            @method('post')
            <input type="text" name="label" value="" class="entryLabel">
            <input type="text" name="value" value="" class="entryValue">
            <input type="text" name="id" class="entryId" value="">
        </form>

        <button class="addEntry" data-type="0">Add Income Entry</button>
        <button class="addEntry" data-type="1">Add Outcome Entry</button>

        <table>
			<tr>
				<td>
				@foreach($entries[0] as $row)
					<tr data-id="{{$row->id}}">
						<td>{{$row->id}}</td>
						<td class="entryName">{{$row->label}}</td>
						<td><input class="entryValue" type="text" size=2 style="font-size: 20px" value="{{$row->value}}"></td>
						<td><button class="editEntryLabel">Edit</button></td>
					</tr>
				@endforeach
				</td>
				<td>
				@foreach($entries[1] as $row)
					<tr data-id="{{$row->id}}">
						<td>{{$row->id}}</td>
						<td class="entryName">{{$row->label}}</td>
						<td><input class="entryValue" type="text" size=2 style="font-size: 20px" value="{{$row->value}}"></td>
						<td><button class="editEntryLabel">Edit</button></td>
					</tr>
				@endforeach
				</td>
        </table>
    </main>
</div>

</body>
</html>




