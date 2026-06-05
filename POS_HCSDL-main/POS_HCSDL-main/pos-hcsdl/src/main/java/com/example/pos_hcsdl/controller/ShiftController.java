package com.example.pos_hcsdl.controller;

import com.example.pos_hcsdl.dto.CloseShiftRequest;
import com.example.pos_hcsdl.dto.CurrentShift;
import com.example.pos_hcsdl.dto.OpenShiftRequest;
import com.example.pos_hcsdl.dto.ShiftResponse;
import com.example.pos_hcsdl.service.ShiftService;
import io.swagger.v3.oas.annotations.tags.Tag;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.web.bind.annotation.*;


@Tag(name = "10. Shift Management")
@RestController
@RequestMapping("/shift")
public class ShiftController {

    @Autowired
    private ShiftService shiftService;

    @PostMapping("/open")
    public CurrentShift openShift(
            @RequestBody OpenShiftRequest openShiftRequest,
            @RequestHeader(name = "X-Restaurant-Id") String restaurantId
    ) {
        return shiftService.openShift(openShiftRequest.getOpenerId(), restaurantId);
    }

    @PostMapping("/close")
    public CurrentShift closeShift(
            @RequestBody CloseShiftRequest closeShiftRequest,
            @RequestHeader(name = "X-Restaurant-Id") String restaurantId
    ) {
        return shiftService.closeShift(closeShiftRequest.getCloserId(), restaurantId);
    }

    @GetMapping("/current")
    public CurrentShift currentShift(
            @RequestHeader(name = "X-Restaurant-Id") String restaurantId
    ) {
        return shiftService.getCurrentShift(restaurantId);
    }

    @GetMapping("/{id}/info")
    public ShiftResponse getShiftInfo(@PathVariable String id) {
        return shiftService.getInformationShift(id);
    }
}
