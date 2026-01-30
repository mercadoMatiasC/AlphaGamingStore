 @props(['question'])

 <div class="bg-black/10 flex flex-col p-5 space-y-3 mt-5">
    <div class="flex flex-row justify-between items-center">
        <p class="font-semibold text-pink-600">{{ $question->user->name }} preguntó:</p>
        @if (auth()->user() && (auth()->user()->is($question->user) || auth()->user()->hasAnyRole(['owner', 'admin'])))
            <div class="w-1/2">
                <form action="/Preguntar/{{ $question->id }}/Eliminar/" method="POST" class="w-full flex items-end justify-end">
                    @csrf
                    @method('PATCH')
                    <x-forms.button class="w-3/4 lg:w-1/2" colour="red" :anchor="false">
                        Eliminar
                    </x-forms.button>    
                </form>
                <x-errors-display />  
            </div>                                     
        @endif
    </div>
    <p>{{ $question->question }}</p>

    @if (auth()->user() && (auth()->user()->is($question->user) || auth()->user()->hasAnyRole(['owner', 'admin'])))
        <form action="/Responder/{{ $question->id }}" method="POST" class="col-span-2 w-full flex justify-between gap-4">
            @csrf
            <x-forms.textarea class="w-full h-12" placeholder="Respuesta" name="answer" required></x-forms.textarea>
            <x-forms.button class="w-1/2 h-12 lg:w-1/5" :anchor="false">
                Responder
            </x-forms.button>    
        </form>
    @endif
    @foreach ($question->answers as $answer)
        <div class="bg-black/50 flex flex-col p-3 rounded-md font-normal mt-3">
            <p class="font-semibold {{ ($answer->user->hasAnyRole(['owner', 'admin']))?'text-pink-500':'' }}">{{ $answer->user->name }} respondió:</p>
            <p>{{ $answer->answer }}</p>
        </div>
    @endforeach
</div>