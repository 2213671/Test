package com.example.pos_hcsdl.mapper;

import com.example.pos_hcsdl.dto.CurrentShift;
import com.example.pos_hcsdl.dto.ShiftResponse;
import com.example.pos_hcsdl.entity.Shift;
import org.mapstruct.Mapper;
import org.mapstruct.Mapping;

@Mapper(componentModel = "spring")
public interface ShiftMapper {
    @Mapping(target = "openerId", source = "opener.id")
    @Mapping(target = "closerId", source = "closer.id")
    CurrentShift getCurrentShift(Shift shift);

    @Mapping(target = "openerId", source = "opener.id")
    @Mapping(target = "closerId", source = "closer.id")
    @Mapping(target = "openerName", source = "opener.username")
    @Mapping(target = "closerName", source = "closer.username")
    ShiftResponse getShiftResponse(Shift shift);
}
