<div class="{$Classes}" style="<% if $RemovePadding == '1' %>padding-left:0;padding-right:0;<% end_if %>">
    <% if $Link %>
        <a href="{$Link}"<% if $OpenLinkInNewTab %> target="_blank"<% end_if %>>{$Image}</a>
    <% else %>
        {$Image}
    <% end_if %>
    <% if $Content %>
        <aside class="typography">
            {$Content}
        </aside><!-- /.typography -->
    <% end_if %>
</div>