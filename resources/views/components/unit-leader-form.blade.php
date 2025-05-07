<form action="{{ route('units.leader.update', $unit) }}" method="POST">
    @csrf
    <div class="mb-3">
        <label class="form-label">Seleccionar Encargado</label>
        <select name="employee_id" class="form-select" required>
            @foreach($unit->members as $member)
                <option value="{{ $member->id }}" 
                    @if($unit->currentLeader?->id === $member->id) selected @endif>
                    {{ $member->person->name }}
                </option>
            @endforeach
        </select>
    </div>
    
    <div class="row mb-3">
        <div class="col-md-6">
            <label class="form-label">Fecha de inicio</label>
            <input type="date" name="start_date" class="form-control" 
                   value="{{ old('start_date', now()->format('Y-m-d')) }}">
        </div>
        <div class="col-md-6">
            <label class="form-label">Fecha final (opcional)</label>
            <input type="date" name="end_date" class="form-control" 
                   value="{{ old('end_date') }}">
        </div>
    </div>
    
    <button type="submit" class="btn btn-primary">
        {{ $unit->currentLeader ? 'Cambiar Encargado' : 'Asignar Encargado' }}
    </button>
</form>