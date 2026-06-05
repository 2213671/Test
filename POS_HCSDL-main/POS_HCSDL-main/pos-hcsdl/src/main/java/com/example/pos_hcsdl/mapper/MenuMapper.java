package com.example.pos_hcsdl.mapper;

import com.example.pos_hcsdl.dto.MenuRequest;
import com.example.pos_hcsdl.dto.MenuResponse;
import com.example.pos_hcsdl.entity.Menu;
import org.mapstruct.Mapper;
import org.mapstruct.Mapping;

import java.util.List;

@Mapper(componentModel = "spring")
public interface MenuMapper {

    @Mapping(target = "restaurantId", source = "restaurant.id")
    MenuResponse getMenuResponse(Menu menu);

    Menu getMenu(MenuRequest menuRequest);

    List<MenuResponse> getMenuResponseList(List<Menu> menus);
}
