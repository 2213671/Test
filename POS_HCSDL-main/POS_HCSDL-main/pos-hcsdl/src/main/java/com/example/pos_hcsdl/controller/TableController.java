package com.example.pos_hcsdl.controller;

import com.example.pos_hcsdl.dto.TableRequest;
import com.example.pos_hcsdl.dto.TableResponse;
import com.example.pos_hcsdl.service.TableService;
import io.swagger.v3.oas.annotations.tags.Tag;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.web.bind.annotation.*;

import java.util.List;

@Tag(name = "3. Table Management")
@RestController
@RequestMapping("/table")
public class TableController {

    @Autowired
    private TableService tableService;

    @PostMapping("/create-table")
    public TableResponse createTable(
            @RequestBody TableRequest tableRequest,
            @RequestHeader(name = "X-Restaurant-Id", required = true) String restaurantId) {
        return tableService.createTable(tableRequest, restaurantId);
    }

    @GetMapping("/restaurant/{id}")
    public List<TableResponse> getTableByRestaurant(@PathVariable String id) {
        return tableService.findTablesByRestaurant(id);
    }

    @GetMapping("/{id}")
    public TableResponse getTableById(@PathVariable String id) {
        return tableService.getTableById(id);
    }

    @PutMapping("/{id}")
    public TableResponse updateTableById(@PathVariable String id, @RequestBody TableRequest tableRequest) {
        return tableService.updateTable(id, tableRequest);
    }
}
