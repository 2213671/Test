package com.example.pos_hcsdl.mapper;

import com.example.pos_hcsdl.dto.MenuRequest;
import com.example.pos_hcsdl.dto.MenuResponse;
import com.example.pos_hcsdl.entity.Menu;
import org.mapstruct.Mapper;

@Mapper(componentModel = "spring")
public interface MenuCreateMapper extends BaseMapper<Menu, MenuRequest, MenuResponse> {
}
