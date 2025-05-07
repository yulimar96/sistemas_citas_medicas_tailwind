@extends('layouts.app')

@section('title', 'Organization Details')

@push('css')
    <style>
        .org-details {
            max-width: 800px;
            margin: 0 auto;
            padding: 1rem;
            background: white;
            border-radius: 0.5rem;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        }
        .section-header {
            font-weight: 700;
            font-size: 1.25rem;
            margin-bottom: 0.5rem;
            border-bottom: 2px solid #3b82f6;
            padding-bottom: 0.25rem;
        }
        .detail-row {
            margin-bottom: 0.75rem;
        }
        .detail-label {
            font-weight: 600;
            color: #374151;
        }
        .detail-value {
            color: #1f2937;
        }
        .back-button {
            margin-bottom: 1rem;
        }
        .org-badge-active {
            background-color: #d1fae5;
            color: #065f46;
            border: 1px solid #34d399;
            padding: 0.25rem 0.5rem;
            border-radius: 0.375rem;
            display: inline-block;
        }
        .org-badge-inactive {
            background-color: #fee2e2;
            color: #991b1b;
            border: 1px solid #f87171;
            padding: 0.25rem 0.5rem;
            border-radius: 0.375rem;
            display: inline-block;
        }
        ul {
            list-style-type: disc;
            padding-left: 1.5rem;
        }
    </style>
@endpush

@section('content')
<div class="p-6 max-w-4xl mx-auto">
    <a href="{{ route('organization.index') }}" class="back-button text-blue-600 hover:underline">&larr; Back to Organizations</a>

    <div class="org-details">
        <h1 class="text-2xl font-bold mb-4">{{ $organization->name }}</h1>

        <div class="detail-row">
            <span class="detail-label">Tax ID:</span>
            <span class="detail-value">{{ $organization->tax_id }}</span>
        </div>

        <div class="detail-row">
            <span class="detail-label">Contact Email:</span>
            <span class="detail-value">{{ $organization->contact_email }}</span>
        </div>

        <div class="detail-row">
            <span class="detail-label">Contact Phone:</span>
            <span class="detail-value">{{ $organization->contact_phone }}</span>
        </div>

        <div class="detail-row">
            <span class="detail-label">Status:</span>
            @if($organization->status)
                <span class="org-badge-active">Active</span>
            @else
                <span class="org-badge-inactive">Inactive</span>
            @endif
        </div>

        <div class="mt-6">
            <h2 class="section-header">Headquarters</h2>
            @if($organization->headquarters->isEmpty())
                <p>No headquarters available.</p>
            @else
                <ul>
                    @foreach($organization->headquarters as $headquarter)
                        <li>
                            <strong>{{ $headquarter->name }}</strong><br>
                            {{ $headquarter->address }}, {{ $headquarter->city }}, {{ $headquarter->state }}<br>
                            Status: 
                            @if($headquarter->status == 'active')
                                <span class="org-badge-active">Active</span>
                            @else
                                <span class="org-badge-inactive">Inactive</span>
                            @endif
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>

        <div class="mt-6">
            <h2 class="section-header">Organizational Units</h2>
            @if($organization->unitTypes->isEmpty())
                <p>No organizational units available.</p>
            @else
                <ul>
                    @foreach($organization->unitTypes as $unitType)
                        <li>
                            <strong>{{ $unitType->name }}</strong><br>
                            Members:
                            @if($unitType->members->isEmpty())
                                <span>No members</span>
                            @else
                                <ul>
                                    @foreach($unitType->members as $member)
                                        <li>{{ $member->name }}</li>
                                    @endforeach
                                </ul>
                            @endif
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>
</div>
@endsection
