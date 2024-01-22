<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Laravel')
<img src="https://us.123rf.com/450wm/111chemodan111/111chemodan1111905/111chemodan111190500006/122811749-vector-monochrome-template-for-a-menu-with-a-chef-fork-spoon.jpg?ver=6" class="logo" alt="Laravel Logo">
@else
{{ $slot }}
@endif
</a>
</td>
</tr>
