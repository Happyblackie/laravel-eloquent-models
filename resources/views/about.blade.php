<!-- 

 for loop
 foreach loop
 for else loop
 while loop

-->

@for($i=0; $i<=10; $i++)
    <h2>number {{ $i }}</h2>
@endfor

@foreach ($names as $name)
    <h2>my name is {{ $name }}</h2>
@endforeach

@forelse ($names as $name)
    <h2>my name is {{ $name }}</h2>
@empty
    <h2>no names available</h2>
@endforelse

{{ $i = 0 }}
@while ($i<10)
    <h2>{{ $i }}</h2>
    {{ $i++ }}
@endwhile