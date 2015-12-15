<div class="{$Classes}">
    <% if $Content %>
        <aside class="typography" style="<% if $MaxWidth %>max-width:{$MaxWidth}px;margin-left: auto;margin-right:auto;'<% end_if %>">
            {$Content}
        </aside><!-- /.typography -->
    <% end_if %>
</div>